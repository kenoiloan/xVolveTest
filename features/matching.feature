Feature: Matching Test
    In order to  matched with someone together that prefer the same thing
    As a business
    We provide matchmaking function for that
    Scenario: As Visitor
        Given I am a guest
        And I know about MatchMaking Application
        When When I Clicked the match button on the screen
        Then I see a list of matched users
     Scenario: As user in system
         Given I am a user
         And I want to be matched with someone that prefer the same thing
         When I require dating
         Then I see myself is matched with someone

