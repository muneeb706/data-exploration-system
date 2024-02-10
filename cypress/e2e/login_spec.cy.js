describe("Login", function () {
  it("logs in", function () {
    cy.login();

    // After login, the user should be redirected to the dashboard. You might
    // need to adjust this URL to match the dashboard URL of your application.
    cy.url().should("include", "/dashboard");
  });

  it('shows an error when logging in with an invalid password', function() {
    cy.login(true);
    // The page should display an error message
    cy.contains('Invalid username or password.')
  })
});
