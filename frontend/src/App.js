import React from 'react';
import { Container, Paper, Typography } from '@mui/material';
import TaskList from './components/Task/TaskList';
import TaskForm from './components/Task/TaskForm';
import useTasks from './hooks/Task/useTasks';

function App() {
    const {
        tasks,
        newTask,
        isEditing,
        errors,
        setNewTask,
        addTask,
        updateTaskDetails,
        removeTask,
        toggleCompletion,
        handleEditClick
    } = useTasks();

    return (
        <Container maxWidth="lg">
            <Paper elevation={3} style={{ padding: '16px', marginTop: '48px', borderRadius: '16px' }}>
                <Typography variant="h5" align="center" gutterBottom style={{ marginBottom: '36px', marginTop: '20px' }}>
                    Lista de Tarefas - AIO Group
                </Typography>

                <TaskForm
                    newTask={newTask}
                    setNewTask={setNewTask}
                    isEditing={isEditing}
                    handleSaveClick={updateTaskDetails}
                    addTask={addTask}
                    errors={errors}
                />
                
                <TaskList
                    tasks={tasks}
                    onToggleCompletion={toggleCompletion}
                    onDeleteTask={removeTask}
                    onEditTask={handleEditClick}
                />
            </Paper>
        </Container>
    );
}

export default App;