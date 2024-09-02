import React from 'react';
import { ListItem, ListItemText, IconButton } from '@mui/material';
import EditIcon from '@mui/icons-material/Edit';
import DeleteIcon from '@mui/icons-material/Delete';
import CheckCircleIcon from '@mui/icons-material/CheckCircle';

const TaskListItem = ({ task, onToggleCompletion, onDeleteTask, onEditTask }) => {
    return (
        <ListItem
            secondaryAction={
                <>
                    <IconButton edge="end" aria-label="edit" onClick={() => onEditTask(task)}>
                        <EditIcon />
                    </IconButton>
                    <IconButton edge="end" aria-label="delete" onClick={() => onDeleteTask(task.id)}>
                        <DeleteIcon />
                    </IconButton>
                </>
            }
            sx={{ borderBottom: '1px solid #ddd', '&:last-child': { borderBottom: 'none' }, paddingRight: '76px' }}
        >
            <ListItemText
                primary={task.title}
                style={{ textDecoration: task.completed ? 'line-through' : 'none' }}
                onClick={() => onToggleCompletion(task.id, task.completed)}
            />
            <IconButton edge="end" aria-label="complete" onClick={() => onToggleCompletion(task.id, task.completed)}>
                <CheckCircleIcon color={task.completed ? 'success' : 'disabled'} />
            </IconButton>
        </ListItem>
    );
};

export default TaskListItem;