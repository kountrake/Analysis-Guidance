<?php


namespace Project\Item;

class Project
{

    private $id;
    private $persona;
    private $userStory;
    private $storyMap;
    private $matrice;
    private $finalScore;

    /**
     * Project constructor.
     * @param int $id
     * @param Persona $persona
     * @param UserStory $userStory
     * @param StoryMap $storyMap
     * @param Matrice $matrice
     * @param FinalScore $finalScore
     */
    public function __construct(int $id, Persona $persona, UserStory $userStory, StoryMap $storyMap, Matrice $matrice, FinalScore $finalScore)
    {
        $this->id = $id;
        $this->persona = $persona;
        $this->userStory = $userStory;
        $this->storyMap = $storyMap;
        $this->matrice = $matrice;
        $this->finalScore = $finalScore;
    }

    /**
     * @return Persona
     */
    public function getPersona(): Persona
    {
        return $this->persona;
    }

    /**
     * @return UserStory
     */
    public function getUserStory(): UserStory
    {
        return $this->userStory;
    }

    /**
     * @return StoryMap
     */
    public function getStoryMap(): StoryMap
    {
        return $this->storyMap;
    }

    /**
     * @return Matrice
     */
    public function getMatrice(): Matrice
    {
        return $this->matrice;
    }

    /**
     * @return FinalScore
     */
    public function getFinalScore(): FinalScore
    {
        return $this->finalScore;
    }
}
