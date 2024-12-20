<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\User;
use App\Repositories\ChatRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Arr;

readonly class RegisteredListener
{
    public function __construct(private ChatRepository $chatRepository)
    {
    }

    public function __invoke(Registered $event): void
    {
        /** @var User $user */
        $user = $event->user;

        $this->chatRepository->systemMessage($this->getWelcomeMessage($user));

        // Send Welcome PM
        $user->sendSystemNotification(
            subject: config('welcomepm.subject'),
            message: config('welcomepm.message'),
        );
    }

    private function getWelcomeMessage(User $user): string
    {
        // Select A Random Welcome Message
        $profileUrl = href_profile($user);

        return Arr::random([
            \sprintf('[url=%s]%s[/url], Welcome to ', $profileUrl, $user->username).config('other.title').'! Hope you enjoy the community.',
            \sprintf("[url=%s]%s[/url], We've been expecting you.", $profileUrl, $user->username),
            \sprintf("[url=%s]%s[/url] has arrived. Party's over.", $profileUrl, $user->username),
            \sprintf("It's a bird! It's a plane! Nevermind, it's just [url=%s]%s[/url].", $profileUrl, $user->username),
            \sprintf('Ready player [url=%s]%s[/url].', $profileUrl, $user->username),
            \sprintf('A wild [url=%s]%s[/url] appeared.', $profileUrl, $user->username),
            'Welcome to '.config('other.title').\sprintf(' [url=%s]%s[/url]. We were expecting you.', $profileUrl, $user->username),
        ]);
    }
}
