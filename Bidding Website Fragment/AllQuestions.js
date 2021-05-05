import db from '../db'
import React, { useState, useEffect } from "react";
import { makeStyles } from "@material-ui/core/styles";
import GridContainer from "../components/Grid/GridContainer.js";
import GridItem from "../components/Grid/GridItem.js";
import styles from "../assets/jss/material-kit-react/views/landingPageSections/productStyle.js";

import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';



const useStyles = makeStyles(styles);

export default function AllQuestions() {


    const classes = useStyles();

    const [allUserQuestions, setAllUserQuestions] = useState([])
    useEffect(() => db.UserQuestions.listenAll(setAllUserQuestions), [])
    return (
        <div className={classes.section}>

            <GridContainer justify="center">
                <GridItem xs={12} sm={12} md={8}>
                    <h2 className={classes.title}>All Questions</h2>
                </GridItem>
            </GridContainer>
            <GridContainer>
                <TableContainer component={Paper}>
                    <Table aria-label="simple table">
                        <TableHead>
                            <TableRow>
                                <TableCell align="right">Questions</TableCell>
                                <TableCell align="right">Answers</TableCell>

                                <TableCell align="right">Show</TableCell>
                                <TableCell align="right">User Id</TableCell>
                                <TableCell align="right">Support Id</TableCell>

                                <TableCell align="right"></TableCell>
                            </TableRow>
                        </TableHead>
                        <TableBody>

                            {
                                allUserQuestions.map(sq =>
                                    <TableRow key={sq.id}>
                                        <TableCell align="right">{sq.question}</TableCell>
                                        <TableCell align="right">{sq.answer}</TableCell>
                                        <TableCell align="right">{`${sq.show}`}</TableCell>
                                        <TableCell align="right">{sq.userId}</TableCell>
                                        <TableCell align="right">{sq.supportUserId}</TableCell>
                                    </TableRow>)
                            }


                        </TableBody>
                    </Table>
                </TableContainer>
            </GridContainer>
        </div>
    )
}
