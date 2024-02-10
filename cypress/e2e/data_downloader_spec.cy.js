// cypress/integration/data_downloader_spec.js
describe("Data Downloader", function () {
  beforeEach(function () {
    // Log in before each test
    cy.login();

    // Visit the data downloader page
    cy.visit("/data_downloader");
  });

  it("loads correctly", function () {
    // Check that the Data Explorer link has the active class
    cy.get("a.nav-link")
      .contains("Data Downloader")
      .parent()
      .should("have.class", "active");
    // The page should contain a data source type dropdown
    cy.get("#data-source-1-type").should("exist");

    // The page should contain a data source name dropdown
    cy.get("#data-source-1-name").should("exist");
  });

  it("loads data grid", () => {
    // Select type of data source
    cy.get("#data-source-1-type").select("table", { force: true });

    // Select name of data source
    cy.get("#data-source-1-name").select("Table1", { force: true });

    // Click submit button
    cy.get("#data-source-submit").click();

    // Check that the data grid is loaded
    cy.get("#data-grid-1").should("exist");
  });
});
