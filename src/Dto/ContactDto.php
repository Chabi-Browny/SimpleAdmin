<?php
namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of ContactDto
 */
class ContactDto
{
    const BLANK_FIELD_MESSAGE = 'Hiba! Kérjük töltsd ki az összes mezőt!';

    public function __construct
    (
        #[Assert\NotBlank(message: self::BLANK_FIELD_MESSAGE)]
        #[Assert\Length(
                min: 5,
                max: 60,
                minMessage: 'Túl kevés karakter! Legalább {{ limit }} hosszú legyen az név.',
                maxMessage: 'Túl sok karakter! Legfeljebb {{ limit }} hosszú lehet az név.')
        ]
        public readonly ?string $name,

        #[Assert\NotBlank(message: self::BLANK_FIELD_MESSAGE)]
        #[Assert\Email(
            message: 'Hiba! Kérjük e-mail címet adjál meg!', /*The email {{ value }} is not a valid email. */
        )]
        #[Assert\Length(
                min: 10,
                max: 120,
                minMessage: 'Túl kevés karakter! Legalább {{ limit }} hosszú legyen az email.',
                maxMessage: 'Túl sok karakter! Legfeljebb {{ limit }} hosszú lehet az email.')
        ]
        public readonly ?string $email,

        #[Assert\NotBlank(message: self::BLANK_FIELD_MESSAGE)]
        #[Assert\Length(
                min: 5,
                max: 500,
                minMessage: 'Túl kevés karakter! Legalább {{ limit }} hosszú legyen az üzenet.',
                maxMessage: 'Túl sok karakter! Legfeljebb {{ limit }} hosszú lehet az üzenet.')
        ]
        public readonly ?string $question
    )
    {
         ///
    }

}
