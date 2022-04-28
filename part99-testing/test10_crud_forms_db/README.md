(0)
assumes project start with testing setup
- so security and user fixtures etc. present


(1)
create entity, e.g. Module
and create CRUD
migrate DB

(2)
create a factory and some fixtures
run fixtures

(2)
secure CRUD controller for ROLE_ADMIN

(3)
add link for CRUD to base template - using Twig is_granted
    - make things easy for yourself - add an HTML id
    - so can easily test if visible with:
            $contentSelector = '#new_module_link';
            $this->assertSelectorNotExists($contentSelector);


create new WebTest class

(4)

test that link is NOT visible for public user
test that link IS visible for logged in ADMIN user
test that link is NOT visible for logged in STUDENT user

==============

create web client:
        // Arrange
        $method = 'GET';
        $url = '/';

        // create client that automatically follow re-directs
        $client = static::createClient();
        $client->followRedirects();

HINTS: - log in user
        // Login user
        $userEmail = 'admin@admin.com';
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($userEmail);
        $client->loginUser($testUser);

create crawler
        // Act
        $crawler = $client->request($httpMethod, $url);

Click link - and successful response on new page
        $linkText = 'create module';
        $client->clickLink($linkText);

        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertSame(Response::HTTP_OK, $statusCode);


HTML select exists/ not exists
        // Assert
        $contentSelector = '#new_module_link';

        // exists
        $this->assertSelectorExists($contentSelector);

        // NOT
        $this->assertSelectorNotExists($contentSelector);