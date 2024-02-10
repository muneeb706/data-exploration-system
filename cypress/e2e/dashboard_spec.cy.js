describe("Dashboard", function () {
  beforeEach(function () {
    // Visit the dashboard page before each test
    cy.login();
  });

  it("loads correctly", function () {
    // The page should contain a chart
    cy.get("#entity5Chart").should("exist");

    // The page should contain a year range input
    cy.get("#year-range").within(() => {
      cy.get("#year-from").should("have.value", "1990");
      cy.get("#year-to").should("have.value", "2000");
    });

    // The page should contain 4 entity cards
    cy.get(".small-box").should("have.length", 4);

    // Check each entity box
    cy.get("#entity1-count").should("exist");
    cy.get("#entity2-count").should("exist");
    cy.get("#entity3-count").should("exist");
    cy.get("#entity4-count").should("exist");
  });

  it("applies year range and element filter for chart", function () {
    // Select a year range
    cy.get("#year-range").within(() => {
      cy.get("#year-from").clear().type("2000");
      cy.get("#year-to").clear().type("2010");
    });

    // Select the second option from the element dropdown
    cy.get("#element-select")
      .find("option")
      .eq(3)
      .then((element) => cy.get("#element-select").select(element.val(), {force: true}));

    // Apply the selection
    cy.get("#chart-submit").click();

    // The page should contain a chart
    cy.get("#entity5Chart").should("exist");
  });
});
