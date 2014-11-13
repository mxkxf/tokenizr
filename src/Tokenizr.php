<?php

class Tokenizr
{

  /**
   * Bank of characters to generate string from.
   * 
   * @var string
   */
  private $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';


  /**
   * Holder for an existing tokens to compare against.
   * 
   * @var array
   */
  private $existingTokens = [];


  /**
   * Generate a new token and sets in existing tokens array.
   * 
   * @param  integer $length
   * @return string
   */
  public function generate($length = 5)
  {
    if (! is_int($length) or $length <= 0)
    {
      throw new \InvalidArgumentException("{$length} is not a valid length of token to generate");
    }
    $token = $this->createRandomString($length);
    if ($this->doesTokenExist($token))
    {
      return $this->generate($length);
    }
    $this->setExistingTokens([$token]);
    return $token;
  }
  
  
  /**
   * Create a random string for use with a token.
   * 
   * @param integer $length
   * @return string
   */
  private function createRandomString($length, $complexity = 5)
  {
    return substr(str_shuffle(str_repeat($this->getCharacters(), $complexity)), 0, $length);
  }


  /**
   * Check if the supplied token already exists.
   * 
   * @param  string $token
   * @return bool
   */
  private function doesTokenExist($token)
  {
    return (bool) in_array($token, $this->getExistingTokens());
  }


  /**
   * Set a new bank of characters.
   * 
   * @param string $characters
   */
  public function setCharacters($characters)
  {
    if (! is_string($characters) or $characters === '')
    {
      throw new \InvalidArgumentException("$characters should be a string");
    }
    $this->characters = $characters;
  }


  /**
   * Get the bank of characters in use.
   * 
   * @return string
   */
  public function getCharacters()
  {
    return $this->characters;
  }


  /**
   * Set the existing tokens array.
   * 
   * @param array $tokens
   */
  public function setExistingTokens($tokens)
  {
    if (! is_array($tokens))
    {
      throw new \InvalidArgumentException("$tokens should be an array");
    }
    $this->existingTokens = $tokens;
  }


  /**
   * Get the existing tokens array.
   * 
   * @return array
   */
  public function getExistingTokens()
  {
    return $this->existingTokens;
  }

}
