<?php

namespace Mongo\ExampleBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\Document
 * @Gedmo\Tree(type="nested")
 * @Gedmo\TranslationEntity(class="Document\CategoryTranslation")
 */
class Category
{
    /**
     * @MongoDB\Id
     */
    private $id;

    /**
     * @Gedmo\Translatable
     * @MongoDB\Field
     */
    private $title;

    /**
     * @Gedmo\Translatable
     * @MongoDB\Field
     */
    private $description;

    /**
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"title"})
     * @MongoDB\Field
     */
    private $slug;

    /**
     * @Gedmo\TreeLeft
     * @MongoDB\Int
     */
    private $lft;

    /**
     * @Gedmo\TreeRight
     * @MongoDB\Int
     */
    private $rgt;

    /**
     * @Gedmo\TreeParent
     * @MongoDB\ReferenceOne(targetDocument="Category", inversedBy="children")
     */
    private $parent;

    /**
     * @Gedmo\TreeRoot
     * @MongoDB\Int
     */
    private $root;

    /**
     * @Gedmo\TreeLevel
     * @MongoDB\Int
     */
    private $level;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Category", mappedBy="parent")
     */
    private $children;

    /**
     * @Gedmo\Timestampable(on="create")
     * @MongoDB\Date
     */
    private $created;

    /**
     * @Gedmo\Timestampable(on="update")
     * @MongoDB\Date
     */
    private $updated;

    /**
     * @Gedmo\Blameable(on="create")
     * @MongoDB\Field
     */
    private $createdBy;

    /**
     * @Gedmo\Blameable(on="update")
     * @MongoDB\Field
     */
    private $updatedBy;

    /**
     * @MongoDB\ReferenceMany( targetDocument="CategoryTranslation", mappedBy="object", cascade={"persist", "remove"} )
     */
    private $translations;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }
}
