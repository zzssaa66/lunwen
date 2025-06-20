<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Paper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PaperSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // 运行角色 seeder
        $this->artisan('db:seed', ['--class' => 'Database\\Seeders\\RolesAndAdminSeeder']);
    }

    public function test_author_can_submit_paper()
    {
        $this->withoutExceptionHandling();
        Storage::fake('local');
        $author = User::factory()->create();
        $author->assignRole('author');

        $response = $this->actingAs($author)->post(route('papers.store'), [
            'title' => 'Test Paper',
            'abstract' => 'This is abstract.',
            'file' => UploadedFile::fake()->create('paper.pdf', 100, 'application/pdf'),
        ]);
        $response->assertRedirect(route('papers.index'));
        $this->assertDatabaseHas('papers', [
            'title' => 'Test Paper',
            'author_id' => $author->id,
            'status' => 'submitted',
        ]);
        $paper = Paper::first();
        Storage::disk('local')->assertExists($paper->file_path);
    }

    public function test_reviewer_cannot_access_unassigned_paper()
    {
        $reviewer = User::factory()->create();
        $reviewer->assignRole('reviewer');
        $author = User::factory()->create();
        $author->assignRole('author');
        Storage::fake('local');
        $paper = Paper::create([
            'title'=>'A','abstract'=>'B','file_path'=>'papers/a.pdf','author_id'=>$author->id,'status'=>'submitted','submitted_at'=>now()
        ]);
        $response = $this->actingAs($reviewer)->get(route('reviewer.papers.show', ['paper' => $paper->id]));
        $response->assertStatus(403);
    }
}