<?php

declare(strict_types=1);

namespace App\Model;

use Stenope\Bundle\Attribute\SuggestedDebugQuery;

#[SuggestedDebugQuery('Actifs', filters: '_.active', orders: 'desc:integrationDate')]
#[SuggestedDebugQuery('Anciens', filters: 'not _.active', orders: 'desc:integrationDate')]
#[SuggestedDebugQuery('Vélotaffeurs', filters: '_.🚲 and _.active', orders: 'desc:integrationDate')]
#[SuggestedDebugQuery('Piétons', filters: 'not _.🚲 and _.active', orders: 'desc:integrationDate')]
class Member
{
    public string $slug;

    // Bio
    public string $name;
    public ?string $gender = null;

    /** Displayed rather than name in articles */
    public ?string $pseudo = null;

    public ?string $bio = null;

    /** Position in the company / job title */
    public ?string $position = null;

    // Social
    public ?string $website = null;
    public ?string $twitter = null;
    public ?string $github = null;
    public ?string $email = null;
    public ?string $avatar = null;
    public ?string $linkedIn = null;

    public ?string $phone = null;

    /** @var string[] */
    public array $certifications = [];

    public ?array $emojis = [];

    // Flags

    public bool $active = false;

    /** Vélotafeur */
    public bool $🚲 = false;

    /** Use an anonymous tribe picture */
    public bool $anonymousTribePicture = false;

    public ?\DateTime $integrationDate = null;
    public ?\DateTimeInterface $lastModified = null;

    /**
     * Fields that requires to be initialized (not nullable, no default value) go in the constructor.
     */
    public function __construct(string $slug, string $name)
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    public function getTribePicture(): string
    {
        return sprintf('images/members/%s.jpg', $this->anonymousTribePicture ? 'default' : $this->slug);
    }

    public function getAvatar(): ?string
    {
        return $this->avatar ?? 'images/members/avatars/default.jpg';
    }
}
