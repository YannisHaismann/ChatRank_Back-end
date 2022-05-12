<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\FindUsersStreamerController;
use App\Controller\CountOfViewersUser;
use App\Controller\ListOfViewersUser;
use App\Controller\ModifyPasswordController;
use App\Controller\RegistrationController;
use App\Controller\UpdateListOfStreamersUser;
use App\Controller\UserByUsernameController;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @Vich\Uploadable()
 */

#[ApiResource(
    collectionOperations: [
        'get',
        'by username' => [
            'method' => 'GET',
            'path' => '/users/find/{username}',
            'controller' => UserByUsernameController::class,
            'filters' => [],
            'pagination_enabled' => false,
            'normalization_context' => [
                'groups' => ['user:read'],
            ],
            'openapi_context' => [
                'summary' => 'Find user by username',
            ]
        ],
        'by type streamer' => [
            'method' => 'GET',
            'path' => '/users/find/users/streamer/{filter}',
            'controller' => FindUsersStreamerController::class,
            'filters' => [],
            'pagination_enabled' => false,
            'normalization_context' => [
                'groups' => ['user:read'],
            ],
            'openapi_context' => [
                'summary' => 'Find users streamer',
            ]
        ],
        'register' => [
            'method' => 'POST',
            'path' => '/users/register',
            'deserialize' => false,
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
                                "type" => "/apip/types/2",
                                "sex" => "/apip/sexes/2",
                                "dateOfBirthday" => "2022-03-16T18:03:09.730Z",
                                "phoneNumber" => "string",
                                "file" => "string",
                                'example' => [
                                    "email" => "string",
                                    "roles" => ["string"],
                                    "password" => "string",
                                    "firstname" => "string",
                                    "lastname" => "string",
                                    "username" => "string",
                                    "type" => "2",
                                    "sex" => "2",
                                    "dateOfBirthday" => "2022-03-16T18:03:09.730Z",
                                    "phoneNumber" => "string",
                                    "file" => "string",
                                ]
                            ]
                        ]
                    ]
                ],
            ],
        ],
    ],
    itemOperations: [
        'get',
        'list viewers user' => [
            'method' => 'GET',
            'path' => '/users/viewers/list/{id}/{filter}',
            'controller' => ListOfViewersUser::class,
            'filters' => [],
            'pagination_enabled' => false,
            'normalization_context' => [
                'groups' => ['user:read'],
            ],
            'openapi_context' => [
                'summary' => 'Returns the list of viewers for a user',

            ]
        ],
        'list streamers user' => [
            'method' => 'GET',
            'path' => '/users/streamers/list/{id}/{filter}',
            'controller' => CountOfViewersUser::class,
            'filters' => [],
            'pagination_enabled' => false,
            'normalization_context' => [
                'groups' => ['user:read'],
            ],
            'openapi_context' => [
                'summary' => 'Returns the list of streamers for a user',

            ]
        ],
        'count streamers' => [
            'method' => 'GET',
            'path' => '/users/streamers/count/{id}',
            'controller' => CountOfViewersUser::class,
            'filters' => [],
            'pagination_enabled' => false,
            'normalization_context' => [
                'groups' => ['user:read'],
            ],
            'openapi_context' => [
                'summary' => 'Returns the count of streamers for a user',
            ]
        ],
        'count viewers' => [
            'method' => 'GET',
            'path' => '/users/viewers/count/{id}',
            'controller' => CountOfViewersUser::class,
            'filters' => [],
            'pagination_enabled' => false,
            'normalization_context' => [
                'groups' => ['user:read'],
            ],
            'openapi_context' => [
                'summary' => 'Returns the count of viewers for a user',

            ]
        ],
        'PUT',
        'DELETE',
        'PATCH',
        'modify password' => [
            'method' => 'POST',
            'path' => '/users/password/{id}/{password}',
            'controller' => ModifyPasswordController::class,
            'filters' => [],
            'pagination_enabled' => false,
            'normalization_context' => [
                'groups' => ['user:read'],
            ],
            'openapi_context' => [
                'summary' => 'Modify password of user',
            ],
        ],
        'add streamer' => [
            'method' => 'POST',
            'path' => '/users/streamer/{id}/{id_streamer}',
            'controller' => UpdateListOfStreamersUser::class,
            'filters' => [],
            'pagination_enabled' => false,
            'normalization_context' => [
                'groups' => ['user:read'],
            ],
            'openapi_context' => [
                'summary' => 'Add and remove a streamers in the list of streamers for a user',
            ],
        ],
    ],
)]

class User implements UserInterface,\Serializable, JWTUserInterface, \Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface
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
     * @var File|null
     * @Vich\UploadableField(mapping="user_image", fileNameProperty="url_profile_img")
     */
    private $file;

    /**
     * @var string|null
     * @Groups ("user:read")
     */
    private ?string $fileUrl;

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
     * @Groups ("user:read")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Sex::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups ("user:read")
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

    /**
     * @ORM\Column(type="datetime")
     * @Groups ("user:read")
     */
    private $date_of_update;

    /**
     * @ORM\OneToOne(targetEntity=LeagueOfLegend::class, mappedBy="user", cascade={"persist", "remove"})
     * @Groups ("user:read")
     */
    private $leagueOfLegend;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
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
        return (string) $this->username;
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

    public function getDateOfUpdate() : ?\DateTimeInterface
    {
        return $this->date_of_update;
    }


    public function setDateOfUpdate(\DateTimeInterface $date_of_update): self
    {
        $this->date_of_update = $date_of_update;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File|null $file
     * @return User
     */
    public function setFile(?File $file): User
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    /**
     * @param string|null $fileUrl
     * @return User
     */
    public function setFileUrl(?string $fileUrl): User
    {
        $this->fileUrl = $fileUrl;
        return $this;
    }

    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    public function unserialize(string $data)
    {
        // TODO: Implement unserialize() method.
    }

    public function getLeagueOfLegend(): ?LeagueOfLegend
    {
        return $this->leagueOfLegend;
    }

    public function setLeagueOfLegend(LeagueOfLegend $leagueOfLegend): self
    {
        // set the owning side of the relation if necessary
        if ($leagueOfLegend->getUser() !== $this) {
            $leagueOfLegend->setUser($this);
        }

        $this->leagueOfLegend = $leagueOfLegend;

        return $this;
    }

    public static function createFromPayload($username, array $payload)
    {
        $user = (new User())->setId($username)->setUsername($payload['username'] ?? '');
        $user->setId($username)->setRoles($payload['roles'] ?? '');
        return $user;
    }
}
