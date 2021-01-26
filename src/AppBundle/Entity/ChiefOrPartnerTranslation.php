<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="chief_or_partner_translation",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="chief_or_partner_translation_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 */
class ChiefOrPartnerTranslation extends AbstractPersonalTranslation
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ChiefOrPartner", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;
}