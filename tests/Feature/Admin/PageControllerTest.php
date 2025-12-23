<?php

namespace Tests\Feature\Admin;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_does_not_delete_sections_when_sections_input_is_missing()
    {
        // 1. Admin kullanıcısı oluştur
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);

        // 2. Bir sayfa ve section oluştur
        $page = Page::create([
            'title' => ['tr' => 'Test Sayfa'],
            'slug' => 'test-sayfa',
            'status' => 'published',
            'index_status' => 'index',
            'follow_status' => 'follow'
        ]);

        $section = PageSection::create([
            'page_id' => $page->id,
            'section_key' => 'hero_slider',
            'order' => 1,
            'is_active' => true,
            'content' => ['title' => 'Test Section']
        ]);

        $this->assertDatabaseHas('page_sections', ['id' => $section->id]);

        // 3. Sayfayı güncelle (sections verisi olmadan)
        // Bu durumda sections array'i gönderilmediği için backend silme işlemi yapmamalı.
        $response = $this->actingAs($admin)->put(route('admin.pages.update', $page), [
            'title' => ['tr' => 'Güncellenmiş Başlık'],
            'slug' => 'test-sayfa',
            'status' => 'published',
            'index_status' => 'index',
            'follow_status' => 'follow'
        ]);
        
        $response->assertRedirect();
        
        // BUG FIX DOĞRULAMASI: 
        // Eğer sections gönderilmezse silinmemeli. (Eskiden siliniyordu)
        $this->assertDatabaseHas('page_sections', ['id' => $section->id]);
    }
}
