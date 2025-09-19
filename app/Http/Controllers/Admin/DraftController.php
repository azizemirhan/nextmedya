<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Draft;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DraftController extends Controller
{
    public function upsert(Request $request)
    {
        $request->validate([
            'draft_key' => ['nullable', 'string', 'max:191'],
            'context' => ['nullable', 'string', 'max:191'],
            'payload' => ['required', 'array'],
            'draftable_type' => ['nullable', 'string', 'max:191'],
            'draftable_id' => ['nullable', 'integer'],
        ]);

        $user = $request->user();
        $key = $request->input('draft_key') ?: Str::uuid()->toString();

        $draft = Draft::updateOrCreate(
            ['user_id' => $user->id, 'draft_key' => $key],
            [
                'context' => $request->string('context')->toString(),
                'payload' => $request->input('payload'),
                'draftable_type' => $request->input('draftable_type'),
                'draftable_id' => $request->input('draftable_id'),
                'expires_at' => now()->addDays(14), // 2 hafta sakla (isteğe göre)
            ]
        );

        return response()->json(['ok' => true, 'draft_key' => $draft->draft_key]);
    }

    public function get(Request $request, string $draftKey)
    {
        $draft = Draft::where('user_id', $request->user()->id)
            ->where('draft_key', $draftKey)
            ->firstOrFail();

        return response()->json([
            'ok' => true,
            'payload' => $draft->payload,
            'context' => $draft->context,
            'draftable_type' => $draft->draftable_type,
            'draftable_id' => $draft->draftable_id,
        ]);
    }

    public function destroy(Request $request, string $draftKey)
    {
        Draft::where('user_id', $request->user()->id)
            ->where('draft_key', $draftKey)
            ->delete();

        return response()->json(['ok' => true]);
    }
}
