<?php

namespace App\Services;

class FacebookService
{
  public function fetchFacebookPosts()
  {
    $pageId = env('FB_PAGE_ID');
    $accessToken = env('FB_ACCESS_TOKEN');

    $fields = 'permalink_url,full_picture,created_time,message';
    $url = "https://graph.facebook.com/v21.0/{$pageId}/feed?fields={$fields}&access_token={$accessToken}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $posts = json_decode($response, true)['data'] ?? [];
    return array_slice($posts, 0, 6);
  }

  public function renderPosts($posts)
  {
    $html = '';
    foreach ($posts as $post) {
        $html .= view('components.post-card', [
            'link' => $post['permalink_url'] ?? null,
            'image' => $post['full_picture'] ?? null,
            'description' => $post['message'] ?? null,
        ])->render();
    }

    while (count($posts) < 6) {
        $html .= view('components.post-card')->render();
        $posts[] = [];
    }

    return $html;
  } 
}