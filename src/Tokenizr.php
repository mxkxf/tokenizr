<?php

class Tokenizr
{

  /**
   * Bank of characters to generate string from
   * 
   * @var string
   */
  private $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';


  /**
   * Holder for an existing tokens to compare against
   * 
   * @var array
   */
  private $existingTokens = [];


  /**
   * Generate a new token
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
    $token = '';
    for ($i = 0; $i < $length; $i ++)
    {
      $token .= $this->getRandomCharacter();
    }
    if ($this->doesTokenExist($token))
    {
      return $this->generate($length);
    }
    $this->setExistingTokens([$token]);
    return $token;
  }


  /**
   * Get a random character from the bank
   * 
   * @return string
   */
  private function getRandomCharacter()
  {
    $characters    = $this->getCharacters();
    $randomElement = rand(0, strlen($characters) - 1);
    return $characters[$randomElement];
  }


  /**
   * Check if the supplied token already exists
   * 
   * @param  string $token
   * @return bool
   */
  public function doesTokenExist($token)
  {
    return (bool) in_array($token, $this->getExistingTokens());
  }


  /**
   * Set a new bank of characters
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
   * Get the bank of characters in use
   * 
   * @return string
   */
  public function getCharacters()
  {
    return $this->characters;
  }


  /**
   * Set the existing tokens array
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
   * Get the existing tokens array
   * 
   * @return array
   */
  public function getExistingTokens()
  {
    return $this->existingTokens;
  }

}
