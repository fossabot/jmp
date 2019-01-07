import Vue from 'vue';

export const groupService = {
    getAll,
    getGroup,
    updateGroup,
    createGroup,
    deleteGroup
};

function getAll() {
    return Vue.axios.get('/groups').then(response => {
        return response.data;
    });
}

function getGroup(id) {
    return Vue.axios.get(`/groups/${id}`).then(response => {
        return response.data;
    });
}

function createGroup(group) {
    return Vue.axios.post('/groups', group).then(response => {
        return response.data;
    });
}

function updateGroup(group) {
    return Vue.axios.put(`/groups/${group.id}`, group).then(response => {
        return response.data;
    });
}

function deleteGroup(id) {
    return Vue.axios.delete(`/groups/${id}`);
}
