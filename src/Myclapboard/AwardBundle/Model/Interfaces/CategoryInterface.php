<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\AwardBundle\Model\Interfaces;

use Myclapboard\CoreBundle\Model\Interfaces\TranslatableInterface;

/**
 * Interface CategoryInterface.
 *
 * @package Myclapboard\AwardBundle\Model\Interfaces
 */
interface CategoryInterface extends TranslatableInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

    /**
     * Sets name.
     *
     * @param string $name The name
     *
     * @return $this self Object
     */
    public function setName($name);

    /**
     * Gets name.
     *
     * @return string
     */
    public function getName();
}
