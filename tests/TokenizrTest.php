<?php

use MikeFrancis\Tokenizr\Tokenizr;

class TokenizrTest extends PHPUnit_Framework_TestCase
{
    protected $tokenizr;

    public function setUp()
    {
        $this->tokenizr = new Tokenizr();
    }

    public function testThrowsAnExceptionForInvalidStringLength()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->tokenizr->setTokenLength('a naughty string');
        $this->tokenizr->setTokenLength(-999);
    }

    public function testReturnRandomString()
    {
        $token = $this->tokenizr->generate();

        $this->assertTrue(is_string($token));
    }

    public function testDoesntCreateDuplicateTokens()
    {
        $this->tokenizr->setCharacters('ab');
        $this->tokenizr->setTokenLength(2);
        $this->tokenizr->setExistingTokens(['aa', 'ab', 'ba']);

        $token = $this->tokenizr->generate();

        $this->assertEquals($token, 'bb');
    }

    public function testThrowsAnExceptionForBadCharacters()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->tokenizr->setCharacters(0);
    }

    public function testThrowsAnExceptionForBadExistingTokens()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->tokenizr->setExistingTokens('a naughty string');
    }
}
