import { useState, useEffect } from 'react';
import { fetchTasks, createTask, updateTask, deleteTask, toggleTaskCompletion } from '../../services/Task/taskService.js';

const useTasks = () => {
    const [tasks, setTasks] = useState([]);
    const [newTask, setNewTask] = useState('');
    const [editingTaskId, setEditingTaskId] = useState(null);
    const [isEditing, setIsEditing] = useState(false);
    const [errors, setErrors] = useState({});

    useEffect(() => {
        fetchTasks()
            .then(setTasks)
            .catch(console.error);
    }, []);

    const addTask = () => {
        createTask(newTask)
            .then(task => {
                setTasks([...tasks, task]);
                setNewTask('');
                setErrors({});
            })
            .catch(error => handleErrors(error));
    };

    const updateTaskDetails = () => {
        updateTask(editingTaskId, newTask)
            .then(updatedTask => {
                setTasks(tasks.map(task => 
                    task.id === editingTaskId ? updatedTask : task
                ));
                resetEditing();
                setErrors({});
            })
            .catch(error => handleErrors(error));
    };

    const removeTask = (id) => {
        deleteTask(id)
            .then(() => {
                setTasks(tasks.filter(task => task.id !== id));
                setErrors({});
            })
            .catch(console.error);
    };

    const toggleCompletion = (id, completed) => {
        toggleTaskCompletion(id, completed)
            .then(updatedTask => {
                setTasks(tasks.map(task => 
                    task.id === id ? updatedTask : task
                ));
                setErrors({});
            })
            .catch(console.error);
    };

    const handleEditClick = (task) => {
        setIsEditing(true);
        setEditingTaskId(task.id);
        setNewTask(task.title);
        setErrors({});
    };

    const resetEditing = () => {
        setIsEditing(false);
        setEditingTaskId(null);
        setNewTask('');
        setErrors({});
    };

    const handleErrors = (error) => {
        if (error.response && error.response.status === 422) {
            setErrors(error.response.data.errors);
        }
    };

    return {
        tasks,
        newTask,
        isEditing,
        errors,
        setNewTask,
        addTask,
        updateTaskDetails,
        removeTask,
        toggleCompletion,
        handleEditClick,
    };
};

export default useTasks;