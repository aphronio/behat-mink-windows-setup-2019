Feature: Google Search Functionality
  
  Scenario: Can find search results with headless browser
    Given I am on "https://www.google.com/ncr"
    When I search for "Google"
    Then I should see "Google"

  @javascript
  Scenario: Can find search results with selenium
  Given I am on "https://www.google.com/ncr"
  When I search for "Google"
  Then I should see "Google"