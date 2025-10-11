<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property array $name
 * @property array|null $keywords
 * @property string $slug
 * @property array|null $description
 * @property array|null $seo_title
 * @property array|null $meta_description
 * @property int $is_active
 * @property int $show_in_sidebar
 * @property int $show_in_menu
 * @property string|null $logo_path
 * @property string|null $banner_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
 * @property-read int|null $posts_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Category active()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereBannerPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereLogoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereShowInMenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereShowInSidebar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category withoutTrashed()
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $chat_session_id
 * @property string $sender_type
 * @property int|null $admin_id
 * @property string $message
 * @property bool $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $admin
 * @property-read mixed $formatted_time
 * @property-read \App\Models\ChatSession $session
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereChatSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereSenderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereUpdatedAt($value)
 */
	class ChatMessage extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $session_id
 * @property string|null $visitor_name
 * @property string|null $visitor_email
 * @property string $visitor_ip
 * @property string $status
 * @property \Illuminate\Support\Carbon $last_activity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ChatMessage> $messages
 * @property-read int|null $messages_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ChatMessage> $unreadAdminMessages
 * @property-read int|null $unread_admin_messages_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ChatMessage> $unreadVisitorMessages
 * @property-read int|null $unread_visitor_messages_count
 * @method static \Illuminate\Database\Eloquent\Builder|ChatSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatSession whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatSession whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatSession whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatSession whereVisitorEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatSession whereVisitorIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatSession whereVisitorName($value)
 */
	class ChatSession extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property string|null $ip
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage search(?string $s)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage unread()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereUserAgent($value)
 */
	class ContactMessage extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array $question
 * @property array $answer
 * @property int $order
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereUpdatedAt($value)
 */
	class Faq extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array $title
 * @property array $description
 * @property string|null $icon
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Feature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feature query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feature whereUpdatedAt($value)
 */
	class Feature extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $sender_id
 * @property string|null $sender_name
 * @property string|null $sender_email
 * @property int|null $recipient_id
 * @property string|null $recipient_email
 * @property string $subject
 * @property string $body
 * @property int $is_read
 * @property int $is_important
 * @property int $is_spam
 * @property int $is_draft
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $recipient
 * @property-read \App\Models\User|null $sender
 * @method static \Illuminate\Database\Eloquent\Builder|Mail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mail onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Mail query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereIsDraft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereIsImportant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereIsSpam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereRecipientEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereRecipientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereSenderEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereSenderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Mail withoutTrashed()
 */
	class Mail extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $uuid
 * @property string $filename
 * @property string $path
 * @property string $disk
 * @property int|null $storage_profile_id
 * @property int|null $folder_id
 * @property string|null $folder_path
 * @property string $extension
 * @property string $mime
 * @property string $type
 * @property int $size_bytes
 * @property int|null $width
 * @property int|null $height
 * @property int|null $duration_ms
 * @property string|null $orientation
 * @property string|null $checksum_sha256
 * @property string|null $etag
 * @property string|null $cdn_path
 * @property string|null $url
 * @property string|null $cdn_url
 * @property int $cdn_cached
 * @property string $visibility
 * @property string $status
 * @property bool $is_active
 * @property bool $is_favorite
 * @property int $order
 * @property string|null $dominant_color
 * @property string|null $palette
 * @property array|null $exif
 * @property array|null $variants
 * @property array|null $title
 * @property array|null $alt
 * @property array|null $caption
 * @property array|null $tags
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\MediaFolder|null $folder
 * @property-read \App\Models\StorageProfile|null $storageProfile
 * @property-read mixed $translations
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCdnCached($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCdnPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCdnUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereChecksumSha256($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDominantColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDurationMs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereEtag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereExif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFolderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFolderPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereIsFavorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereOrientation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media wherePalette($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereSizeBytes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereStorageProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereVariants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereVisibility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Media withoutTrashed()
 */
	class Media extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int|null $parent_id
 * @property string $path
 * @property string $visibility
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, MediaFolder> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Media> $galleries
 * @property-read int|null $galleries_count
 * @property-read MediaFolder|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFolder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFolder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFolder query()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFolder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFolder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFolder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFolder whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFolder wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFolder whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFolder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFolder whereVisibility($value)
 */
	class MediaFolder extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array $name
 * @property string $slug
 * @property string $placement
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MenuItem> $items
 * @property-read int|null $items_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu wherePlacement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 */
	class Menu extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $menu_id
 * @property int|null $parent_id
 * @property int|null $page_id
 * @property int|null $service_id
 * @property array $title
 * @property string|null $url
 * @property string $target
 * @property string|null $classes
 * @property string|null $rel
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, MenuItem> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, MenuItem> $childrenRecursive
 * @property-read int|null $children_recursive_count
 * @property-read \App\Models\Menu $menu
 * @property-read MenuItem|null $parent
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereClasses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereRel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereUrl($value)
 */
	class MenuItem extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $email
 * @property string $status
 * @property string $token
 * @property string|null $ip
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterSubscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterSubscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterSubscriber query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterSubscriber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterSubscriber whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterSubscriber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterSubscriber whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterSubscriber whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterSubscriber whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterSubscriber whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterSubscriber whereUserAgent($value)
 */
	class NewsletterSubscriber extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array $title
 * @property array|null $banner_title
 * @property array|null $banner_subtitle
 * @property string $slug
 * @property string $status
 * @property array|null $seo_title
 * @property array|null $meta_description
 * @property array|null $keywords
 * @property string $index_status
 * @property string $follow_status
 * @property string|null $canonical_url
 * @property array|null $og_title
 * @property array|null $og_description
 * @property string|null $og_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PageSection> $sections
 * @property-read int|null $sections_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereBannerSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereBannerTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCanonicalUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereFollowStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereIndexStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereOgDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereOgImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereOgTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $page_id
 * @property string $section_key
 * @property array|null $content
 * @property int $order
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Page $page
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection query()
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection whereSectionKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageSection whereUpdatedAt($value)
 */
	class PageSection extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $version
 * @property string|null $author
 * @property string|null $author_uri
 * @property string|null $description
 * @property string|null $license
 * @property string|null $plugin_uri
 * @property string|null $repository_url
 * @property string|null $download_url
 * @property bool $is_active
 * @property bool $is_installed
 * @property array|null $requirements
 * @property array|null $dependencies
 * @property array|null $settings
 * @property array|null $permissions
 * @property string|null $main_file
 * @property string|null $namespace
 * @property string|null $provider_class
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $last_check
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PluginInstallation> $installations
 * @property-read int|null $installations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereAuthorUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereDependencies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereDownloadUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereIsInstalled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereLastCheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereLicense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereMainFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereNamespace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin wherePluginUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereProviderClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereRepositoryUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plugin whereVersion($value)
 */
	class Plugin extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $plugin_id
 * @property string $version
 * @property string $action
 * @property string $status
 * @property string|null $message
 * @property array|null $details
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $action_label
 * @property-read string|null $duration
 * @property-read string $formatted_created_at
 * @property-read string $status_color
 * @property-read string $status_label
 * @property-read \App\Models\Plugin $plugin
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation byAction($action)
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation failed()
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation query()
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation successful()
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation wherePluginId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PluginInstallation whereVersion($value)
 */
	class PluginInstallation extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array $title
 * @property string $slug
 * @property array $content
 * @property array|null $excerpt
 * @property string|null $featured_image
 * @property array|null $featured_image_alt_text
 * @property int $user_id Yazar
 * @property int|null $category_id
 * @property string $status
 * @property string $visibility
 * @property string|null $password
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property int|null $last_modified_by Son düzenleyen kullanıcı
 * @property array|null $seo_title
 * @property array|null $meta_description
 * @property array|null $keywords
 * @property string|null $canonical_url
 * @property string $index_status
 * @property string $follow_status
 * @property string $schema_type
 * @property array|null $manual_schema_json
 * @property array|null $generated_schema_json
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $author
 * @property-read \App\Models\Category|null $category
 * @property-read string $published_date_formatted
 * @property-read \App\Models\User|null $lastModifiedBy
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @property-read mixed $translations
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Post published()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCanonicalUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereFeaturedImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereFeaturedImageAltText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereFollowStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereGeneratedSchemaJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIndexStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereLastModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereManualSchemaJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSchemaType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereVisibility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Post withoutTrashed()
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag query()
 */
	class PostTag extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array $title
 * @property string $slug
 * @property array $description
 * @property array|null $location
 * @property \Illuminate\Support\Carbon|null $completion_date
 * @property string $image_path
 * @property int $status
 * @property bool $is_featured
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCompletionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array $title
 * @property string $slug
 * @property array|null $summary
 * @property array|null $banner_title
 * @property array|null $banner_subtitle
 * @property array|null $content
 * @property array|null $benefits
 * @property array|null $expectations_content
 * @property array|null $support_items
 * @property array|null $faqs
 * @property string|null $cover_image
 * @property array|null $gallery_images
 * @property int $order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereBannerSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereBannerTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCoverImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereExpectationsContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereFaqs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereGalleryImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereSupportItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Service withoutTrashed()
 */
	class Service extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $key
 * @property array|null $value
 * @property bool $is_translatable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereIsTranslatable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array $title
 * @property array $subtitle
 * @property array|null $button_text
 * @property string|null $button_url
 * @property string $image_path
 * @property int $order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereButtonText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereButtonUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider withoutTrashed()
 */
	class Slider extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $icon
 * @property string $number
 * @property array $title
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic whereUpdatedAt($value)
 */
	class Statistic extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Media> $galleries
 * @property-read int|null $galleries_count
 * @method static \Illuminate\Database\Eloquent\Builder|StorageProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageProfile query()
 */
	class StorageProfile extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
 * @property-read int|null $posts_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 */
	class Team extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array $name
 * @property array $position
 * @property string $photo
 * @property string|null $facebook_url
 * @property string|null $twitter_url
 * @property string|null $linkedin_url
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereFacebookUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereLinkedinUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereTwitterUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamMember whereUpdatedAt($value)
 */
	class TeamMember extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property array $name
 * @property array $company
 * @property array $content
 * @property string|null $image_path
 * @property int $order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial query()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereUpdatedAt($value)
 */
	class Testimonial extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $profession
 * @property string|null $username
 * @property string|null $image
 * @property string|null $phone
 * @property string|null $country
 * @property string|null $address
 * @property string|null $location
 * @property string|null $website
 * @property array|null $socials
 * @property string|null $notes
 * @property string $email
 * @property int $is_admin
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Mail> $receivedMails
 * @property-read int|null $received_mails_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Mail> $sentMails
 * @property-read int|null $sent_mails_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSocials($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWebsite($value)
 */
	class User extends \Eloquent {}
}

