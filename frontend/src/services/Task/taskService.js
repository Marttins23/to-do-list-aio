import axios from 'axios';

export const fetchTasks = () => {
    return axios.get('http://127.0.0.1:8000/api/tasks')
        .then(response => response.data);
};

export const createTask = (title) => {
    return axios.post('http://127.0.0.1:8000/api/tasks', { title })
        .then(response => response.data);
};

export const updateTask = (id, title) => {
    return axios.put(`http://127.0.0.1:8000/api/tasks/${id}`, { title })
        .then(response => response.data);
};

export const deleteTask = (id) => {
    return axios.delete(`http://127.0.0.1:8000/api/tasks/${id}`);
};

export const toggleTaskCompletion = (id, completed) => {
    return axios.put(`http://127.0.0.1:8000/api/tasks/${id}`, { completed: !completed })
        .then(response => response.data);
};
