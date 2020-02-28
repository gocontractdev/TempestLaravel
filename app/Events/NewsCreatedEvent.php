<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewsCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $title;

    private $url;

    public function __construct($title, $url = '')
    {
        $this->title = $title;
        $this->url = $url;
    }

    public function getData()
    {
        return [
          'title' => $this->title,
          'url' => $this->url,
        ];
    }
}
