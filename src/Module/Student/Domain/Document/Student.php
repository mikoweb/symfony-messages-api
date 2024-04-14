<?php

namespace App\Module\Student\Domain\Document;

use App\Module\Student\Infrastructure\Repository\StudentRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Uid\Uuid;

#[MongoDB\Document(repositoryClass: StudentRepository::class)]
class Student
{
    #[MongoDB\Id(type: 'string', strategy: 'NONE')]
    private string $id;

    public function __construct()
    {
        $this->id = (string) Uuid::v4();
    }

    public function getId(): string
    {
        return $this->id;
    }
}
