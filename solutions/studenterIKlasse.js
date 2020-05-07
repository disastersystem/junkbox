
fetch('studenter.json')
    .then(res => res.json())
    .then(students => {
        // hent <ul> lista så vi kan legge til studenter senere
        let ul = document.querySelector('ul.studenter')

        // finn alle input elementer av typen "radio"
        let radioButtons = document.querySelectorAll('input[type="radio"]')

        // iterer igjennom samlingen med alle radio elementene
        radioButtons.forEach(radioButton => {
            // legg til en event listener på radio knappen
            radioButton.addEventListener('click', e => {
                // tøm lista med studenter før vi legger til nye
                ul.innerHTML = ""
                // iterer igjennom samlingen med alle studentene
                students.forEach(student => {
                    // hvis IDen til radioknappen er lik studenten sin klasse-forkortelse, eller lik 'all',
                    // så lag et <li> element og legg til det i <ul> lista
                    if (student.forkortelse == radioButton.id || radioButton.id == 'all') {
                        let li = document.createElement('li')
                        li.innerHTML = `
                            <p class="name">
                                ${student.fornavn} ${student.etternavn}
                            </p>
                            <p class="studyprogram">
                                ${student.studieprogram} ${student.forkortelse}
                            </p>`
                        ul.appendChild(li)
                    }
                })
            })
        })
    })