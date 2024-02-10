import { testUser } from './constants'

// Custom command to log in
Cypress.Commands.add("login", (error=false) => {
  // Intercept the POST request to the login endpoint
  cy.visit("/login");
  cy.get("input[name=username]").type((!error ? testUser["username"]: "wronguser"));
  cy.get("input[name=password]").type(testUser["password"]);
  cy.get("form").submit();
});
