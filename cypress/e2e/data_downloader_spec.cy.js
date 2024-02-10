// cypress/integration/data_downloader_spec.js
describe('Data Downloader', function() {
    beforeEach(function() {
      // Log in before each test
      cy.login()
  
      // Visit the data downloader page
      cy.visit('/data_downloader')
    })
  
    it('loads correctly', function() {
      // The page should contain a data source type dropdown
      cy.get('#data-source-1-type').should('exist')
  
      // The page should contain a data source name dropdown
      cy.get('#data-source-1-name').should('exist')
    })
  })