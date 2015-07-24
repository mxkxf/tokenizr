<?php

use MikeFrancis\Tokenizr;

class TokenizrTest extends PHPUnit_Framework_TestCase
{
    protected $tokenizr;

    public function setUp()
    {
        $this->tokenizr = new Tokenizr;
    }

    public function testThrowsAnExceptionForInvalidStringLength()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $this->tokenizr->generate('a naughty string');
        $this->tokenizr->generate(-999);
    }
  
    public function testReturnRandomString()
    {
        $token = $this->tokenizr->generate();

        $this->assertTrue(is_string($token));
    }

    public function testDoesntCreateDuplicateTokens()
    {
        $this->tokenizr->setCharacters('ab');
        $this->tokenizr->setExistingTokens(['aa', 'ab', 'ba']);
        
        $token = $this->tokenizr->generate(2);

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
