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
            axios.patch(this.endpoint, {
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
        },
        destroy() {
            if (confirm('Are you sure you want to delete this answer?')) {
                axios.delete(this.endpoint)
                    .then(res => { this.$emit('deleted') })
            }
        },
    },

    computed: {
        isInvalid() {
            return this.body.length < 10;
        },
        endpoint() {
            return `/questions/${this.questionId}/answers/${this.id}`;
        }
    }
}
</script>