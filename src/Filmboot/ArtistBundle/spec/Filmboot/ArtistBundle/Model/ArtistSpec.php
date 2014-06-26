<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmboot\ArtistBundle\Model;

use Filmboot\ArtistBundle\Entity\Actor;
use Filmboot\ArtistBundle\Entity\Director;
use Filmboot\ArtistBundle\Entity\Writer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ArtistSpec.
 *
 * @package spec\Filmboot\ArtistBundle\Model
 */
class ArtistSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Filmboot\ArtistBundle\Model\Artist');
    }

    function it_implements_artist_interface()
    {
        $this->shouldImplement('Filmboot\ArtistBundle\Model\ArtistInterface');
    }

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function its_slug_is_mutable()
    {
        $this->setFirstName('Leonardo')->shouldReturn($this);

        $this->setSlug()->shouldReturn($this);
        $this->getSlug()->shouldReturn('leonardo');

        $this->setLastName('DiCaprio')->shouldReturn($this);

        $this->setSlug()->shouldReturn($this);
        $this->getSlug()->shouldReturn('leonardo-dicaprio');

        $this->setFirstName('')->shouldReturn($this);

        $this->setSlug()->shouldReturn($this);
        $this->getSlug()->shouldReturn('dicaprio');
    }

    function its_first_name_is_mutable()
    {
        $this->setFirstName('Leonardo')->shouldReturn($this);
        $this->getFirstName()->shouldReturn('Leonardo');
    }

    function its_last_name_is_mutable()
    {
        $this->setLastName('DiCaprio')->shouldReturn($this);
        $this->getLastName()->shouldReturn('DiCaprio');
    }

    function its_birthday_is_mutable()
    {
        $birthday = new \DateTime('1974-11-11');

        $this->setBirthday($birthday)->shouldReturn($this);
        $this->getBirthday()->shouldReturn($birthday);
    }

    function its_birthplace_is_mutable()
    {
        $this->setBirthplace('Los Ángeles, California, USA')->shouldReturn($this);
        $this->getBirthplace()->shouldReturn('Los Ángeles, California, USA');
    }

    function its_biography_is_mutable()
    {
        $this->setBiography(
            'Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in eum liber hendrerit an.'
        )->shouldReturn($this);
        $this->getBiography()->shouldReturn(
            'Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in eum liber hendrerit an.'
        );
    }

    function its_actors_be_mutable(Actor $actor)
    {
        $this->getActors()->shouldHaveCount(0);

        $this->addActor($actor);

        $this->getActors()->shouldHaveCount(1);

        $this->removeActor($actor);

        $this->getActors()->shouldHaveCount(0);
    }

    function its_director_be_mutable(Director $director)
    {
        $this->getDirectors()->shouldHaveCount(0);

        $this->addDirector($director);

        $this->getDirectors()->shouldHaveCount(1);

        $this->removeDirector($director);

        $this->getDirectors()->shouldHaveCount(0);
    }

    function its_writers_be_mutable(Writer $writer)
    {
        $this->getWriters()->shouldHaveCount(0);

        $this->addWriter($writer);

        $this->getWriters()->shouldHaveCount(1);

        $this->removeWriter($writer);

        $this->getWriters()->shouldHaveCount(0);
    }
}
