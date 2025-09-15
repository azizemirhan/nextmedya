<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        return view('admin.blogs.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        $users = User::all();
        return view('admin.blogs.edit', compact('post', 'users'));
    }

    public function create()
    {
        $users = User::where('role', 'admin')->get();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.blogs.create', compact('categories', 'tags', 'users'));
    }

    public function generateSchema(Post $post)
    {
        return json_encode([
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $post->title,
            "description" => $post->meta_description,
            "image" => asset('images/posts/' . $post->featured_image),
            "author" => [
                "@type" => "Person",
                "name" => $post->author->name,
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "Senin Şirket İsmin",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => asset('logo.png')
                ]
            ],
            "datePublished" => $post->published_at,
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:500',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:80048',
            'published_at' => 'nullable|date',
            'author_id' => 'required|exists:users,id',
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->content;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;

        // Öne çıkan görsel işlemi
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/featured_images'), $filename);
            $post->featured_image = 'uploads/featured_images/' . $filename;
        }

        $post->published_at = $request->published_at ? Carbon::parse($request->published_at) : null;
        $post->author_id = $request->author_id;
        $post->status = $request->status;

        // 🧠 Otomatik Schema Markup üretimi
        $author = User::find($request->author_id);

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $request->meta_title ?? $request->title,
            'description' => $request->meta_description ?? Str::limit(strip_tags($request->content), 160),
            'author' => [
                '@type' => 'Person',
                'name' => $author->name,
            ],
            'datePublished' => optional($post->published_at)->toIso8601String(),
            'image' => $post->featured_image ? asset($post->featured_image) : null,
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => url('/blog/' . $post->slug),
            ]
        ];

        $post->schema_markup = json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        $post->save();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog yazısı başarıyla oluşturuldu.');
    }


    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/summernote'), $filename);

            return response()->json([
                'url' => asset('uploads/summernote/' . $filename)
            ]);
        }
    }

    // Yazı düzenleme sayfası

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:60000',
            'published_at' => 'nullable|date',
            'author_id' => 'required|exists:users,id',
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
        ]);

        $post = Post::findOrFail($id);

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->content;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;

        // Öne çıkan görsel işlemi
        if ($request->hasFile('featured_image')) {
            // Eski resmi sil
            if ($post->featured_image && file_exists(public_path($post->featured_image))) {
                unlink(public_path($post->featured_image));
            }

            // Yeni resmi yükle
            $file = $request->file('featured_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/featured_images'), $filename);
            $post->featured_image = 'uploads/featured_images/' . $filename;
        }

        $post->published_at = $request->published_at ? Carbon::createFromFormat('Y-m-d', $request->published_at) : null;
        $post->author_id = $request->author_id;
        $post->status = $request->status;

        if ($request->filled('schema_markup')) {
            $post->schema_markup = $request->schema_markup;
        } else {
            // 🧠 Otomatik Schema Markup üretimi (manuel girilmemişse)
            $author = User::find($request->author_id);

            $schema = [
                '@context' => 'https://schema.org',
                '@type' => 'BlogPosting',
                'headline' => $request->meta_title ?? $request->title,
                'description' => $request->meta_description ?? Str::limit(strip_tags($request->content), 160),
                'author' => [
                    '@type' => 'Person',
                    'name' => $author->name,
                ],
                'datePublished' => optional($post->published_at)->toIso8601String(),
                'image' => $post->featured_image ? asset($post->featured_image) : null,
                'mainEntityOfPage' => [
                    '@type' => 'WebPage',
                    '@id' => url('/blog/' . $post->slug),
                ]
            ];

            $post->schema_markup = json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }

        $post->save();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog yazısı başarıyla güncellendi.');
    }



    // Yazıyı silme işlemi
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Yazı başarıyla silindi!');
    }
}
