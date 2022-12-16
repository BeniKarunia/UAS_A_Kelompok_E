describe('New Arrivals Component Test', function() {

  let component;

  before(async () => {
    component = await browser.mountVueComponent('/src/components/new-arrivals/NewArrivals.vue', {
      plugins: {
        store: '/src/lib/store.js',
        router: '/src/lib/router.js'
      },

      mocks: {
        '/data/new-arrivals.json': {
          type: 'fetch',
          body: {
            books: [
              {
                "title": "The Psychology of Money",
      "author": "Morgan Housel",
      "image": "https://books.google.co.id/books/publisher/content?id=TnrrDwAAQBAJ&pg=PA1&img=1&zoom=3&hl=en&bul=1&sig=ACfU3U2hGkeh28bJEM7dkh2ZagypPDBqIw&w=1280",
      "price": 500000,
      "currency": "Rp. ",
      "category": "Business & Economics",
      "isbn13": 9781101911815,
      "description": "The Psychology of Money explores how money moves around in an economy and how personal biases and the emotional factor play an important role in our financial decisions, as well as how to think more rationally and make better decisions when it comes to money."
              }
            ]
          }
        }
      }
    })
  });

  it('tests the component', function(browser) {
    // const newArrivalsValue = await component.getProperty('newArrivals');
    // console.log('newArrivals', newArrivalsValue)

    expect(component).to.be.visible;
    expect(component).to.have.property('newArrivals');

    expect(component).text.toContain('The Psychology of Money')

    expect(component.findAll('div.col-md-6')).length(1);

    expect(component.property('newArrivals')).to.be.an('array').with.length(1);
  });

  it('logs the innerHTML property', async function(browser) {
    const innerHTML = await browser.getElementProperty(component, 'innerHTML');
    browser.assert.textContains(component, 'The Psychology of Money');
  });
});
