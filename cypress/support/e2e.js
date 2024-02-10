import "./commands";
import "./index"

// for exceptions caused by loaded scripts/plugins
Cypress.on("uncaught:exception", (err, runnable) => {
  // Prevents Cypress from failing the test
  return false;
});
