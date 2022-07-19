function callAddress(event) {
    window.axios.defaults.headers.common = {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    };
    const address = document.getElementById('address').value
    const resultElement = document.querySelector('.result')
    resultElement.innerHTML = ''
    const link = `https://kr-api.tomtom.com/search/2/geocode/${address}.json?key=MtC8XS7dGHVqDy6SPK1zWiLfRmG28cBF&typeahead=true`
    axios.get(link).then(response => {
        const attempts = response.data.results
        console.log(attempts);
        attempts.forEach(item => {
            const divElement = document.createElement('div')
            divElement.classList.add('list-result')
            const markup = `<span>${item.address.freeformAddress}</span>`
            divElement.insertAdjacentHTML('beforeend', markup)
            divElement.addEventListener('click', function() {
                document.getElementById('address').value = item.address.freeformAddress
                document.getElementById('latitude').value = item.position.lat
                document.getElementById('longitude').value = item.position.lon
                resultElement.innerHTML = ''
                resultElement.setAttribute('hidden','true')
            })
            resultElement.append(divElement)
            resultElement.removeAttribute('hidden')
        });
    })
}
