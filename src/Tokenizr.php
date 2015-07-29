<?php namespace MikeFrancis;

use InvalidArgumentException;

class Tokenizr
{
    /**
     * The complexity of each token.
     *
     * @const int
     */
    const TOKENIZR_COMPLEXITY = 5;

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
     * Default token length.
     * 
     * @var integer
     */
    private $length = 5;

    /**
     * Generate a new token and sets in existing tokens array.
     *
     * @return string
     */
    public function generate()
    {
        $token = $this->createRandomString();

        if ($this->doesTokenExist($token)) {
            return $this->generate();
        }

        $this->existingTokens[] = $token;

        return $token;
    }

    /**
     * Create a random string for use with a token.
     *
     * @return string
     */
    private function createRandomString()
    {
        $characters = $this->getCharacters();
        
        return substr(str_shuffle(str_repeat($characters, self::TOKENIZR_COMPLEXITY)), 0, $this->getTokenLength());
    }

    /**
     * Check if the supplied token already exists.
     *
     * @param string $token
     * @return bool
     */
    private function doesTokenExist($token)
    {
        return (bool) in_array($token, $this->getExistingTokens());
    }

    /**
     * Set the length of the tokens generated.
     * 
     * @param int $length
     * @return void
     */
    public function setTokenLength($length)
    {
        if (! is_int($length) or $length <= 0) {
            throw new InvalidArgumentException("$length is should be an integer greater than 0");
        }

        $this->length = $length;
    }

    /**
     * Get the token length.
     * 
     * @return int
     */
    public function getTokenLength()
    {
        return $this->length;
    }

    /**
     * Set a new bank of characters.
     *
     * @param string $characters
     * @throws InvalidArgumentException
     * @return void
     */
    public function setCharacters($characters)
    {
        if (! is_string($characters) or $characters === '') {
            throw new InvalidArgumentException("$characters should be a string");
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
     * @throws InvalidArgumentException
     * @return void
     */
    public function setExistingTokens($tokens)
    {
        if (! is_array($tokens)) {
            throw new InvalidArgumentException("$tokens should be an array");
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
