import db from '../db'
import React, { useState, useEffect, useContext } from "react";
import UserContext from '../UserContext'
import { makeStyles } from "@material-ui/core/styles";
import styles from "../assets/jss/material-kit-react/views/landingPageSections/productStyle.js";
import GridContainer from "../components/Grid/GridContainer";
import GridItem from "../components/Grid/GridItem.js";
import NavPills from "../components/NavPills/NavPills.js"
import Card from '@material-ui/core/Card';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
import Button from '@material-ui/core/Button';
import TextField from '@material-ui/core/TextField';
import CloudUploadIcon from '@material-ui/icons/CloudUpload';
import SaveIcon from '@material-ui/icons/Save';
import InputLabel from '@material-ui/core/InputLabel';
import MenuItem from '@material-ui/core/MenuItem';
import FormControl from '@material-ui/core/FormControl';
import Select from '@material-ui/core/Select';

import {
    Link
} from "react-router-dom";




export default function FAQ() {
    const useStyles = makeStyles(styles);

    const { user } = useContext(UserContext)

    const classes = useStyles();
    //FAQ
    const [faqId, setFaqId] = useState('')
    const [question, setQuestion] = useState("")
    const [answer, setAnswer] = useState("")

    const [faqs, setFaqs] = useState([])
    useEffect(() => db.FAQ.listenAll(setFaqs), [])

    const create = async () => {
        await db.FAQ.create({ question, answer, supportUserId: user.id })
        setQuestion("")
        setAnswer("")
    }

    const edit = faq => {
        setFaqId(faq.id)
        setQuestion(faq.question)
        setAnswer(faq.answer)
    }

    const save = async (faq) => {
        await db.FAQ.update({ id: faqId, question, answer, supportUserId: user.id })
        setQuestion("")
        setAnswer("")
    }

    const remove = async (faq) => {
        await db.FAQ.remove(faq.id)
        edit(faq)
    }

    const [validCreate, setValidCreate] = useState(false)
    useEffect(() => {
        const validateCreate = async () =>
            question.length > 0 &&
            answer.length > 0
        const getData = async () => {
            setValidCreate(await validateCreate())
        }
        getData()
    }, [question, answer])

    const [validSave, setValidSave] = useState(false)
    useEffect(() => {
        const validateSave = async () =>
            question.length > 0 &&
            answer.length > 0
        // undefined !== await db.FAQ.findOne(faqId)

        const getData = async () => {
            setValidSave(await validateSave())
        }
        getData()
    }, [question, answer])

    //User Questions
    const [allUserQuestions, setAllUserQuestions] = useState([])
    useEffect(() => db.UserQuestions.listenAll(setAllUserQuestions), [])

    const [specificQuestions, setspecificQuestions] = useState([])
    useEffect(() => {
        user && db.UserQuestions.listenToQuestionsByUserId(setspecificQuestions, user.id)
        

    }, [user])
    ////console.log("specific question", specificQuestions)

   // //console.log("all qs", allUserQuestions)

    const [userQuestionId, setUserQuestionId] = useState('')
    const [userQuestions, setUserQuestions] = useState('')
    const [userAnswer, setUserAnswer] = useState('')
    const [show, setShow] = useState(false)
    const [userId, setUserId] = useState('')
    const [supportUserId, setSupportUserId] = useState('')

    const createUserQuestion = async () => {
        await db.UserQuestions.create({ question: userQuestions, userId: user.id, answer: "", show })
        // , userId: user.Id, supportUserId: ""
        setUserQuestions("")
    }

    const editUserQuestion = sq => {
        setUserQuestionId(sq.id)
        setUserQuestions(sq.question)
        setUserAnswer(sq.answer)
        setShow(sq.show)
        setUserId(sq.userId)
        setSupportUserId(user.id)
    }

    const saveUserQuestion = async (sq) => {
        await db.UserQuestions.update({ id: userQuestionId, question: userQuestions, answer: userAnswer, show, userId: userId, supportUserId: user.id })
        setUserQuestions("")
        setUserAnswer("")
        setShow(false)
        setUserId("")
        setSupportUserId("")
    }

    const removeUserQuestion = async (sq) => {
        await db.UserQuestions.remove(sq.id)
        editUserQuestion(sq)
    }


    return (

        <div className={classes.section}>
            <div className={classes.container}>
                <div id="navigation-pills">
                    <div style={{ textAlign: "center", color: "black" }} className={classes.title}>
                        <h3><b>Support Page</b></h3>
                    </div>
                    <GridContainer >
                        <GridItem xs={12} >
                            <NavPills
                                color="rose"
                                horizontal={{
                                    tabsGrid: { xs: 12, sm: 4, md: 4 },
                                    contentGrid: { xs: 8 }
                                }}
                                tabs={[
                                    {
                                        tabButton: "FAQs",
                                        tabContent: (
                                            <TableContainer component={Paper}>
                                                <Table aria-label="simple table">
                                                    <TableHead>
                                                        <TableRow>
                                                            <TableCell align="right">Questions</TableCell>
                                                            <TableCell align="right">Answers</TableCell>
                                                            <TableCell align="right"></TableCell>

                                                        </TableRow>
                                                    </TableHead>
                                                    <TableBody>
                                                        {
                                                            user && user.role === "support"
                                                                ?
                                                                <TableRow >

                                                                    <TableCell align="right">
                                                                        <TextField required id="question" label="Question" value={question} onChange={event => setQuestion(event.target.value)} />
                                                                    </TableCell>
                                                                    <TableCell align="right">
                                                                        <TextField required id="answer" label="Answer" value={answer} onChange={event => setAnswer(event.target.value)} />
                                                                    </TableCell>



                                                                    <TableCell align="center">
                                                                        <Button
                                                                            variant="contained"
                                                                            color="default"
                                                                            startIcon={<CloudUploadIcon />}
                                                                            onClick={() => create()}
                                                                            disabled={!validCreate}
                                                                        >
                                                                            Create
                                                                </Button>

                                                                &nbsp;
                                                                <Button
                                                                            variant="contained"
                                                                            color="primary"
                                                                            startIcon={<SaveIcon />}
                                                                            onClick={() => save()}
                                                                            disabled={!validSave}
                                                                        >
                                                                            Save
                                                                </Button>


                                                                    </TableCell>
                                                                </TableRow>
                                                                :
                                                                null
                                                        }

                                                        {
                                                            faqs.map(faq =>
                                                                <TableRow key={faq.id}>
                                                                    <TableCell align="right">{faq.question}</TableCell>
                                                                    <TableCell align="right">{faq.answer}</TableCell>
                                                                    <TableCell>
                                                                    {
                                                                        user && user && user.role === "support" ?
                                                                            <>
                                                                                <Button onClick={() => edit(faq)}>Edit</Button>
                                                                                <Button onClick={() => remove(faq)}>Delete</Button>
                                                                            </>
                                                                            : null
                                                                    }
                                                                    </TableCell>
                                                                </TableRow>
                                                            )
                                                        }
                                                    </TableBody>
                                                </Table>
                                            </TableContainer>
                                        )
                                    },
                                    {
                                        tabButton: "Ask a question",
                                        // tabIcon: Dashboard,
                                        tabContent: (
                                            <TableContainer component={Paper}>
                                                <Table aria-label="simple table">
                                                    <TableHead>
                                                        <TableRow>
                                                            <TableCell align="right">Questions</TableCell>
                                                            <TableCell align="right">Answers</TableCell>
                                                            {
                                                                user && user.role === "support" ?
                                                                    <>
                                                                        <TableCell align="right">Show</TableCell>
                                                                        <TableCell align="right">User Id</TableCell>
                                                                        <TableCell align="right">Support Id</TableCell>
                                                                    </>
                                                                    :
                                                                    null
                                                            }
                                                            <TableCell align="right"></TableCell>
                                                        </TableRow>
                                                    </TableHead>
                                                    <TableBody>
                                                        {
                                                            user &&
                                                                (user.role === "buyer" || user.role === "seller" || user.role === "support")
                                                                ?
                                                                <TableRow >

                                                                    <TableCell align="right">
                                                                        <TextField required id="userQuestions" label="Question" value={userQuestions} onChange={event => setUserQuestions(event.target.value)} />
                                                                    </TableCell>

                                                                    <TableCell align="right">
                                                                        {
                                                                            user && user.role !== "support" ?
                                                                                <TextField disabled required id="userAnswer" label="Answer" value={userAnswer} onChange={event => setUserAnswer(event.target.value)} />
                                                                                :
                                                                                <TextField required id="userAnswer" label="Answer" value={userAnswer} onChange={event => setUserAnswer(event.target.value)} />
                                                                        }
                                                                    </TableCell>
                                                                    {
                                                                        user && user.role === "support" ?
                                                                            <>
                                                                                <TableCell align="right">
                                                                                    {/* <TextField required id="show" label="Show" value={show} onChange={event => setShow(event.target.value)} /> */}
                                                                                    <FormControl style={{ minwidth: 250 }}>
                                                                                        <InputLabel id="demo-simple-select-label">Branch Name</InputLabel>
                                                                                        <Select
                                                                                            labelId="demo-simple-select-label"
                                                                                            id="show"
                                                                                            value={show}
                                                                                            onChange={event => setShow(event.target.value)}
                                                                                        >

                                                                                            <MenuItem key={true} value={true}>True</MenuItem>
                                                                                            <MenuItem key={false} value={false}>False</MenuItem>
                                                                                        </Select>
                                                                                    </FormControl>
                                                                                </TableCell>
                                                                                <TableCell align="right">
                                                                                    <TextField disabled id="userId" label="User Id" value={userId} onChange={event => setUserId(event.target.value)} />
                                                                                </TableCell>
                                                                                <TableCell align="right">
                                                                                {/* value={supportUserId}  */}
                                                                                    <TextField disabled id="supportUserId" label="support User Id" value={supportUserId}  onChange={event => setSupportUserId(event.target.value)} />
                                                                                </TableCell>
                                                                            </> : null
                                                                    }



                                                                    <TableCell align="center">
                                                                        {
                                                                            user && user.role !== "support" ?
                                                                                <Button
                                                                                    variant="contained"
                                                                                    color="default"
                                                                                    startIcon={<CloudUploadIcon />}
                                                                                    onClick={() => createUserQuestion()}
                                                                                // disabled={!validCreate}
                                                                                >
                                                                                    Create
                                                                                </Button>
                                                                                :
                                                                                <Button
                                                                                    variant="contained"
                                                                                    color="primary"
                                                                                    startIcon={<SaveIcon />}
                                                                                    onClick={() => saveUserQuestion()}
                                                                                // disabled={!validSave}
                                                                                >
                                                                                    Save
                                                                                </Button>
                                                                        }




                                                                    </TableCell>
                                                                </TableRow>
                                                                :
                                                                null
                                                        }

                                                        {

                                                            user && user.role === "support" ?
                                                                allUserQuestions.map(sq =>
                                                                    <TableRow key={sq.id}>
                                                                        <TableCell align="right">{sq.question}</TableCell>
                                                                        <TableCell align="right">{sq.answer}</TableCell>
                                                                        <TableCell align="right">{`${sq.show}`}</TableCell>
                                                                        <TableCell align="right">{sq.userId}</TableCell>
                                                                        <TableCell align="right">{sq.supportUserId}</TableCell>

                                                                        <TableCell align="right">
                                                                            <Button onClick={() => editUserQuestion(sq)}>Edit</Button>
                                                                            <Button onClick={() => removeUserQuestion(sq)}>Delete</Button>
                                                                        </TableCell>
                                                                    </TableRow>
                                                                )
                                                                :

                                                                specificQuestions.map(sq =>
                                                                    <TableRow key={sq.id}>
                                                                        <TableCell align="right">{sq.question}</TableCell>
                                                                        {
                                                                            sq.show === true ?
                                                                                <TableCell align="right">{sq.answer}</TableCell>
                                                                                : null
                                                                        }

                                                                    </TableRow>
                                                                )
                                                        }
                                                    </TableBody>
                                                </Table>
                                            </TableContainer>
                                        )
                                    },
                                    {
                                        tabButton: "Chat",
                                        tabContent: (
                                            <Card>
                                                
                                                {
                                                    user && user.role === "support" ?
                                                    <>
                                                    <h1>Moderate all Chats</h1>
                                                        <Button
                                                            color="primary"
                                                            className={classes.navLink}
                                                            component={Link}
                                                            to="/allChats"
                                                        >
                                                            View all Chats
                                                      </Button>
                                                      </>
                                                        :
                                                        <>
                                                        <h1>Chat with the Support Team</h1>
                                                        <Button
                                                            color="primary"
                                                            className={classes.navLink}
                                                            component={Link}
                                                            to="/chat"
                                                        >
                                                            Chat with the Support Team
                                                        </Button>
                                                        </>
                                                }
                                            </Card>
                                        )
                                    }
                                ]}
                            />
                        </GridItem>
                    </GridContainer>
                </div>
            </div>
        </div>
    )
}
