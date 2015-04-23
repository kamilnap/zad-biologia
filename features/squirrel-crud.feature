Feature: I would like to edit reptiles

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/squirrel/"
    Then I should not see "<squirrel>"
    And I follow "Create a new entry"
    Then I should see "Squirrel creation"
    When I fill in "Name" with "<squirrel>"
    And I fill in "Age" with "<age>"
    And I press "Create"
    Then I should see "<squirrel>"
    And I should see "<age>"

  Examples:
    | squirrel     | age |
    | trojbarwna       | 3  |
    | palmowa    | 5 |
    | pospolita   | 7  |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/squirrel/"
    Then I should not see "<new-squirrel>"
    When I follow "<old-squirrel>"
    Then I should see "<old-squirrel>"
    When I follow "Edit"
    And I fill in "Name" with "<new-squirrel>"
    And I fill in "Age" with "<new-age>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-squirrel>"
    And I should see "<new-age>"
    And I should not see "<old-squirrel>"

  Examples:
    | old-squirrel     | new-squirrel  | new-age    |
    | trojbarwna           | T-R-O-J-B-A-R-W-N-A       | 4       |
    | pospolita          | P-O-S-P-O-L-I-T-A       | 5       |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/squirrel/"
    Then I should see "<squirrel>"
    When I follow "<squirrel>"
    Then I should see "<squirrel>"
    When I press "Delete"
    Then I should not see "<squirrel>"

  Examples:
    |  squirrel    |
    | trojbarwna   |
    | P-O-S-P-O-L-I-T-A  |
    | P-O-S-P-O-L-I-T-A  |

