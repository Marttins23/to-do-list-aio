import React from 'react';
import { TextField, Button } from '@mui/material';

const TaskForm = ({ newTask, setNewTask, isEditing, handleSaveClick, addTask, errors }) => {
    return (
        <>
            <div style={{ display: 'flex' }}>
                <TextField
                    variant="outlined"
                    label="Nova Tarefa"
                    size="small"
                    fullWidth
                    value={newTask}
                    onChange={(e) => setNewTask(e.target.value)}
                    sx={{ borderRadius: '8px', '& .MuiOutlinedInput-root': { borderRadius: '8px' } }}
                />
                <Button
                    variant="contained"
                    size="small"
                    onClick={isEditing ? handleSaveClick : addTask}
                    sx={{
                        background: 'rgb(82, 20, 138)',
                        marginLeft: '8px',
                        borderRadius: '8px',
                        '& .MuiOutlinedInput-root': { borderRadius: '8px' }
                    }}
                >
                    {isEditing ? 'Salvar' : 'Adicionar'}
                </Button>
            </div>
            <div style={{color: 'red', fontSize: '14px', paddingLeft: '4px', marginBottom: '16px'}}>
                {errors.title && <span>{errors.title[0]}</span>}
            </div>
        </>

    );
};

export default TaskForm;