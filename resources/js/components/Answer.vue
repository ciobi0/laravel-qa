<template></template>
<script>
export default {
    props: ['answer'],
    data() {
        return {
            editing: false,
            body: this.answer.body,
            bodyHtml: this.answer.body_html,
            id: this.answer.id,
            questionId: this.answer.question_id,
            beforeEditCache: null
        }
    },
    methods: {
        update() {
            axios.patch(`/questions/${this.questionId}/answers/${this.id}`, {
                body: this.body
            }).then(res => {
                this.bodyHtml = res.data.body_html;
                this.editing = false;
                flash('Your answer has been updated');
            }).catch(err => {
                alert(err.response.data.message);
            });
        },
        edit() {
            this.beforeEditCache = this.body;
            this.editing = true;
        },
        cancel() {
            this.body = this.beforeEditCache;
            this.editing = false;
        }
    },
    computed: {
        isInvalid() {
            return this.body.length < 10;
        }
    }
}
</script>