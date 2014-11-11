<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TokenizrSpec extends ObjectBehavior
{

  function it_throws_an_exception_for_a_string_length()
  {
    $this->shouldThrow('\InvalidArgumentException')->during('generate', ['a naughty string']);
  }


  function it_throws_an_exception_for_a_bad_integer_length()
  {
    $this->shouldThrow('\InvalidArgumentException')->during('generate', [-999]);
  }

  
  function it_returns_a_random_string()
  {
    $this->generate()->shouldBeString();
  }


  function it_doesnt_create_duplicate_tokens()
  {
    $this->setCharacters('ab');
    $this->setExistingTokens(['aa', 'ab', 'ba']);
    $this->generate(2)->shouldReturn('bb');
  }


  function it_sets_bad_characters()
  {
    $this->shouldThrow('\InvalidArgumentException')->during('setCharacters', [0]);
  }


  function it_sets_bad_existing_tokens()
  {
    $this->shouldThrow('\InvalidArgumentException')->during('setExistingTokens', ['a naughty string']);
  }

}