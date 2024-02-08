// cypress/support/e2e.js

// Custom command to log in
Cypress.Commands.add('login', (username, password) => {
    cy.visit('/login')
    cy.get('input[name=username]').type(username)
    cy.get('input[name=password]').type(password)
    cy.get('form').submit()
  })