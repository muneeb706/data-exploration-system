import { testUser } from "./constants";

// create testuser for all tests
before(() => {
  cy.request({
    method: "POST",
    url: "http://localhost:8000/create_test_user/",
    body: testUser,
  });
});
