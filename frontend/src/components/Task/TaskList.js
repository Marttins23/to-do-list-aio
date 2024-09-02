import React from 'react';
import { List } from '@mui/material';
import TaskListItem from './TaskListItem';

const TaskList = ({ tasks, onToggleCompletion, onDeleteTask, onEditTask }) => {
    return (
        <List>
            {tasks.map(task => (
                <TaskListItem 
                    key={task.id} 
                    task={task} 
                    onToggleCompletion={onToggleCompletion} 
                    onDeleteTask={onDeleteTask} 
                    onEditTask={onEditTask}
                />
            ))}
        </List>
    );
};

export default TaskList;