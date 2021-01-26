<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="tournament_table_translation",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="tournament_table_translation_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 */
class TournamentTableTranslation extends AbstractPersonalTranslation
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TournamentTable", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;
}