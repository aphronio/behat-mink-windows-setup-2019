<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends Behat\MinkExtension\Context\MinkContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /** @When /^I search for "([^"]*)"$/ */
    public function iSearchFor($searchText) {
        $this->fillField('q', $searchText);
    }

    /** @Then /^I wait for "([^"]*)" seconds$/*/
    public function iWaitFor($seconds)
    {
        $this->getSession()->wait($seconds*1000);
        // $this->assertSession()->pageTextContains($text);
    }

    /**
     * @When I wait for element with id :text to appear
     * @Then I should see element with id :text appear
     * @param $text
     * @throws \Exception
     */
    public function iWaitForElementWithIdToAppear($text)
    {
        $this->spins(function() use ($text) {
            $this->getSession()->getPage()->findById($text);
        });
    }

    /**
     * @When I wait for :text to appear
     * @Then I should see :text appear
     * @param $text
     * @throws \Exception
     */
    public function iWaitForTextToAppear($text)
    {
        $this->spins(function() use ($text) {
            $this->assertSession()->pageTextContains($text);
        });
    }

    
    /**
     * This method simulates dropping a file in dropzone
     * @When I upload :filePath
     * @param $filePath
     */
    public function dropFile($filePath)
    {
        $javascipt_create_file_input = <<<HEREDOC
            var fakeFileInput = window.$('<input/>').attr(
                {id: 'fakeFileInput', type:'file'}
            ).appendTo('body');
        HEREDOC;
        $this->getSession()->executeScript($javascipt_create_file_input);
        $this->attachFileToField( "fakeFileInput", $filePath );
        $javascipt_trigger_upload_event = <<<HEREDOC
            fileList = [$('input#fakeFileInput')[0].files[0]]
            e = jQuery.Event('drop', { dataTransfer : { files : fileList } });
            $('.dropzone')[0].dropzone.listeners[0].events.drop(e);
            console.log("Upload event triggered");
        HEREDOC;
        $this->getSession()->executeScript($javascipt_trigger_upload_event);
    }

    public function spins($closure, $tries = 10)
    {
        for ($i = 0; $i <= $tries; $i++) {
            try {
                $closure();

                return;
            } catch (\Exception $e) {
                if ($i == $tries) {
                    throw $e;
                }
            }

            sleep(1);
        }
    }
}
