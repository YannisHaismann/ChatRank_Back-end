<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\RegistrationController;
use App\Controller\UserByUsernameController;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */

#[ApiResource(
    collectionOperations: [
        'get',
        'by username' => [
            'method' => 'GET',
            'path' => '/users/find',
            'controller' => UserByUsernameController::class,
            'filters' => [],
            'pagination_enabled' => false,
            'openapi_context' => [
                'summary' => 'Find user by username',
                'parameters' => [
                    [
                        'in' => 'query',
                        'name' => 'username',
                        'schema' => [
                            'type' => 'string'
                        ]
                    ]
                ]
            ]
        ],
        'register' => [
            'method' => 'POST',
            'path' => '/users/register',
            'controller' => RegistrationController::class,
            'openapi_context' => [
                'summary' => 'User registration',
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                "email" => "string",
                                "roles" => ["string"],
                                "password" => "string",
                                "firstname" => "string",
                                "lastname" => "string",
                                "username" => "string",
                                "type" => "string",
                                "sex" => "string",
                                "viewers" => ["string"],
                                "streamers" => ["string"],
                                "dateOfBirthday" => "2022-03-16T18:03:09.730Z",
                                "urlProfileImg" => "string",
                                "phoneNumber" => "string",
                                "file" => "file",
                                'example' => [
                                    "email" => "string",
                                    "roles" => ["string"],
                                    "password" => "string",
                                    "firstname" => "string",
                                    "lastname" => "string",
                                    "username" => "string",
                                    "type" => "string",
                                    "sex" => "string",
                                    "viewers" => ["string"],
                                    "streamers" => ["string"],
                                    "dateOfBirthday" => "2022-03-16T18:03:09.730Z",
                                    "urlProfileImg" => "string",
                                    "phoneNumber" => "string",
                                    "file" => "file",
                                ]
                            ]
                        ]
                    ]
                ],
                'parameters' => [
                    [
                        'in' => 'query',
                        'name' => 'email',
                        'schema' => [
                            'type' => 'string'
                        ],
                    ],
                    [
                        'in' => 'query',
                        'name' => 'roles',
                        'schema' => [
                            'type' => 'list'
                        ],
                    ],
                    [
                        'in' => 'query',
                        'name' => 'password',
                        'schema' => [
                            'type' => 'string'
                        ],
                    ],
                    [
                        'in' => 'query',
                        'name' => 'firstname',
                        'schema' => [
                            'type' => 'string'
                        ],
                    ],
                    [
                        'in' => 'query',
                        'name' => 'lastname',
                        'schema' => [
                            'type' => 'string'
                        ],
                    ],
                    [
                        'in' => 'query',
                        'name' => 'username',
                        'schema' => [
                            'type' => 'string'
                        ],
                    ],
                    [
                        'in' => 'query',
                        'name' => 'sex',
                        'schema' => [
                            'type' => 'integer'
                        ],
                    ],
                    [
                        'in' => 'query',
                        'name' => 'viewers',
                        'schema' => [
                            'type' => 'list'
                        ],
                    ],
                    [
                        'in' => 'query',
                        'name' => 'streamers',
                        'schema' => [
                            'type' => 'list'
                        ],
                    ],
                    [
                        'in' => 'query',
                        'name' => 'dateOfBirthday',
                        'schema' => [
                            'type' => 'date'
                        ],
                    ],
                    [
                        'in' => 'query',
                        'name' => 'urlProfileImg',
                        'schema' => [
                            'type' => 'string'
                        ],
                    ],
                    [
                        'in' => 'query',
                        'name' => 'phoneNumber',
                        'schema' => [
                            'type' => 'String'
                        ],
                    ],
                    [
                        'in' => 'query',
                        'name' => 'file',
                        'schema' => [
                            'type' => 'file'
                        ],
                    ],
                ],
            ]
        ]
    ]
)]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups ("user:read")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups ("user:read")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups ("user:read")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("user:read")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("user:read")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("user:read")
     */

    private $username;

    /**
     * @ORM\Column(type="datetime")
     * @Groups ("user:read")
     */
    private $date_of_birthday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups ("user:read")
     */
    private $url_profile_img;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups ("user:read")
     */
    private $phone_number;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Sex::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sex;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     * @Groups ("user:read")
     */
    private $viewers = [];

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     * @Groups ("user:read")
     */
    private $streamers = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getDateOfBirthday(): ?\DateTimeInterface
    {
        return $this->date_of_birthday;
    }

    public function setDateOfBirthday(\DateTimeInterface $date_of_birthday): self
    {
        $this->date_of_birthday = $date_of_birthday;

        return $this;
    }

    public function getUrlProfileImg(): ?string
    {
        return $this->url_profile_img;
    }

    public function setUrlProfileImg(?string $url_profile_img): self
    {
        $this->url_profile_img = $url_profile_img;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSex(): ?Sex
    {
        return $this->sex;
    }

    public function setSex(?Sex $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getViewers(): ?array
    {
        return $this->viewers;
    }

    public function setViewers(?array $viewers): self
    {
        $this->viewers = $viewers;

        return $this;
    }

    public function getStreamers(): ?array
    {
        return $this->streamers;
    }

    public function setStreamers(?array $streamers): self
    {
        $this->streamers = $streamers;

        return $this;
    }
}
