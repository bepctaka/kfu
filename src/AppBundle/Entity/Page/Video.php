<?php

namespace AppBundle\Entity\Page;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VideoRepository")
 */
class Video extends BasePage
{
    /**
     * @Assert\NotBlank(message="Поле не должно быть пустым")
     * @Assert\Regex( "/http(s?)\:\/\/W+/i", message="Введите корректный URL или iframe")
     * @ORM\Column(name="url", type="string")
     */
    private $url;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
