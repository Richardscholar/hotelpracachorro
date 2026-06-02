// Seleciona todas as perguntas
const faqQuestions = document.querySelectorAll('.faq-question');

faqQuestions.forEach((question) => {
    question.addEventListener('click', () => {
        const answer = question.nextElementSibling;

        // Fecha qualquer outra resposta aberta
        faqQuestions.forEach((q) => {
            if (q !== question) {
                q.nextElementSibling.style.maxHeight = null;
                q.nextElementSibling.style.paddingTop = '0';
                q.nextElementSibling.style.paddingBottom = '0';
            }
        });

        // Alterna a resposta clicada
        if (answer.style.maxHeight) {
            answer.style.maxHeight = null;
            answer.style.paddingTop = '0';
            answer.style.paddingBottom = '0';
        } else {
            answer.style.maxHeight = answer.scrollHeight + "px";
            answer.style.paddingTop = '15px';
            answer.style.paddingBottom = '15px';
        }
    });
});