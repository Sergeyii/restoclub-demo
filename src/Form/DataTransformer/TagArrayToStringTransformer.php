<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form\DataTransformer;

use App\Entity\Tag;
use App\Repository\TagRepository;
use App\Service\Manage\TagService;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * This data transformer is used to translate the array of tags into a comma separated format
 * that can be displayed and managed by Bootstrap-tagsinput js plugin (and back on submit).
 *
 * See https://symfony.com/doc/current/form/data_transformers.html
 *
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 * @author Jonathan Boyer <contact@grafikart.fr>
 */
class TagArrayToStringTransformer implements DataTransformerInterface
{
    private $tags;
    private $service;

    public function __construct(TagRepository $tags, TagService $service)
    {
        $this->tags = $tags;
        $this->service = $service;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($tags): string
    {
        // The value received is an array of Tag objects generated with
        // Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer::transform()
        // The value returned is a string that concatenates the string representation of those objects

        /* @var Tag[] $tags */
        return implode(',', $tags);
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($string): array
    {
        if ('' === $string || null === $string) {
            return [];
        }

        $names = array_filter(array_unique(array_map('trim', explode(',', $string))));

        // Get the current tags and find the new ones that should be created.
        $tags = $this->tags->findBy([
            'title' => $names,
        ]);

        $newNames = array_diff($names, $tags);
        foreach ($newNames as $name) {
            $tag = new Tag();
            $tag->setTitle($name);
            $tag = $this->service->setDefaultsWhenAdding($tag);
            $tags[] = $tag;

            // There's no need to persist these new tags because Doctrine does that automatically
            // thanks to the cascade={"persist"} option in the App\Entity\Post::$tags property.
        }

        // Return an array of tags to transform them back into a Doctrine Collection.
        // See Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer::reverseTransform()
        return $tags;
    }
}