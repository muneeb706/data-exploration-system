describe("Login", function () {
  it("logs in", function () {
    // Visit the login page. You might need to adjust this URL to match
    // the login URL of your application.
    cy.visit("/login");

    // Find the email input field, type in a valid email address
    cy.get("input[name=username]").type("muneeb706");

    // Find the password input field, type in a valid password
    cy.get("input[name=password]").type("1234ABCDe");

    // Find the login form and submit it
    cy.get("form").submit();

    // After login, the user should be redirected to the dashboard. You might
    // need to adjust this URL to match the dashboard URL of your application.
    cy.url().should("include", "/dashboard");
  });

  it('shows an error when logging in with an invalid password', function() {
    // Visit the login page. You might need to adjust this URL to match
    // the login URL of your application.
    cy.visit("/login");
    // Type a valid email into the email input field
    cy.get('input[name=username]').type('muneeb706')

    // Type an invalid password into the password input field
    cy.get('input[name=password]').type('wrong-password')

    // Submit the login form
    cy.get('form').submit()

    // The page should display an error message
    cy.contains('Invalid username or password.')
  })
});
