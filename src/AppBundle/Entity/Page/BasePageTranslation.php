<?php

namespace AppBundle\Entity\Page;

use Doctrine\ORM\Mapping as ORM;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="base_page_translation",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="base_page_translation_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 */
class BasePageTranslation extends AbstractPersonalTranslation
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Page\BasePage", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;
}